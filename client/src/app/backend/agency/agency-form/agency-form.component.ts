import { Component, OnInit, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AgencyService } from '../agency.service';

@Component({
    selector: 'dialog-agency-form',
    templateUrl: 'agency-form.component.html',
})
export class DialogAgencyForm implements OnInit {

    agencyForm: FormGroup;
    agency: any = {
        id: "",
        name: "",
        description: ""
    }

    games: Array<any> = [];

    ngOnInit(): void {
        this.agencyForm = this.fb.group({
            id: [this.agency.id],
            name: [this.agency.name, Validators.required],
            description: [this.agency.description, Validators.required],
            games: this.fb.group({
                game_id: ["", Validators.required],
                name: [""],
                percent_share: ["", Validators.required]
            })
        });

        // this.updateValidator();
    }

    constructor(
        public dialogRef: MatDialogRef<DialogAgencyForm>,
        @Inject(MAT_DIALOG_DATA) public data: any,
        private fb: FormBuilder,
        private agencyService: AgencyService,
    ) { 
        if(data && data.id) {
            this.agency = data;
            for(let value of data.games) {
                this.games.push({
                    game_id: value.id,
                    name: value.name,
                    percent_share: value.pivot.percent_share,
                })
            }
        }
    }

    onSubmit() {
        let formData = this.agencyForm.value;
        this.updateValidator();
        
        if(this.agencyForm.valid) {
            formData.games = this.games;

            this.agencyService.postAgency(formData).subscribe(
                (req) => {
                    this.dialogRef.close();
                }
            )
        }
    }

    onChangeGame($event) {
        console.log($event);
        this.agencyForm.get('games').get('name').setValue($event.name);
    }

    updateValidator(): any {
        console.log(this.games);
        if(this.games && this.games.length > 0) {
            this.agencyForm.get('games').get('game_id').clearValidators();
            this.agencyForm.get('games').get('percent_share').clearValidators();
        } else {
            this.agencyForm.get('games').get('game_id').setValidators(Validators.required);
            this.agencyForm.get('games').get('percent_share').setValidators(Validators.required);
        }
        
        this.agencyForm.get('games').get('game_id').updateValueAndValidity();
        this.agencyForm.get('games').get('percent_share').updateValueAndValidity();
    }

    addGame() {
        let gameForm = this.agencyForm.get("games");

        if(gameForm.valid) {
            this.games = this.games.filter(
                (value) => {
                    return value.game_id != gameForm.value.game_id;
                }
            )
            this.games.push(gameForm.value);
            // this.updateValidator();
        }
    }

    removeGame(index) {
        this.games.splice(index, 1);
        // this.updateValidator();
    }

    onNoClick(): void {
        this.dialogRef.close();
    }
}