import { Component, OnInit, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { UserService } from '../../user/user.service';

@Component({
    selector: 'dialog-admin-user-form',
    templateUrl: 'admin-user-form.component.html',
})
export class DialogAdminUserForm implements OnInit {

    adminUserForm: FormGroup;
    user: any = {
        id: "",
        username: "",
        password: ""
    }

    roles: Array<any> = [];

    ngOnInit(): void {
        this.adminUserForm = this.fb.group({
            id: [this.user.id],
            username: [this.user.name, Validators.required],
            password: ["", Validators.required],
            cfpassword: ["", Validators.required],
            roles: this.fb.group({
                id: ["", Validators.required],
                name: [""],
            })
        });

        // this.updateValidator();
    }

    constructor(
        public dialogRef: MatDialogRef<DialogAdminUserForm>,
        @Inject(MAT_DIALOG_DATA) public data: any,
        private fb: FormBuilder,
        private userService: UserService,
    ) { 
        if(data && data.id) {
            this.user = data;
            for(let value of data.roles) {
                this.roles.push({
                    id: value.id,
                    name: value.name,
                })
            }
        }
    }

    onSubmit() {
        let formData = this.adminUserForm.value;
        this.updateValidator();
        
        if(this.adminUserForm.valid) {
            formData.roles = this.roles;

            this.userService.postAdminUser(formData).subscribe(
                (req) => {
                    this.dialogRef.close();
                }
            )
        }
    }

    onChangeGame($event) {
        console.log($event);
        this.adminUserForm.get('roles').get('name').setValue($event.name);
    }

    updateValidator(): any {
        console.log(this.roles);
        if(this.roles && this.roles.length > 0) {
            this.adminUserForm.get('roles').get('id').clearValidators();
        } else {
            this.adminUserForm.get('roles').get('id').setValidators(Validators.required);
        }
        
        this.adminUserForm.get('roles').get('id').updateValueAndValidity();
    }

    addRole() {
        let gameForm = this.adminUserForm.get("roles");

        if(gameForm.valid) {
            this.roles = this.roles.filter(
                (value) => {
                    return value.id != gameForm.value.id;
                }
            )
            this.roles.push(gameForm.value);
            // this.updateValidator();
        }
    }

    removeRole(index) {
        this.roles.splice(index, 1);
        // this.updateValidator();
    }

    onNoClick(): void {
        this.dialogRef.close();
    }
}