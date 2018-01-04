import { Component, OnInit, Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AccountService } from '../account.service';

@Component({
  selector: 'app-account-form',
  templateUrl: './account-form.component.html',
  styleUrls: ['./account-form.component.scss']
})
export class DialogAccountForm implements OnInit {
  accountForm: FormGroup;
  account: any = {
      name: '',
      password: ''
  }

  ngOnInit(): void {
      this.accountForm = this.fb.group({
          name: [this.account.name, Validators.required],
          password: [this.account.password, Validators.required]
      });
  }

  constructor (
      public dialogRef: MatDialogRef<DialogAccountForm>,
      @Inject(MAT_DIALOG_DATA) public data: any,
      private fb: FormBuilder,
      private accountService: AccountService,
  ) {
      if (data) {
          this.account = data;
      }
  }

  onSubmit() {
      if (this.accountForm.valid) {
          this.accountService.postAccount(this.accountForm.value).subscribe(
              (req) => {
                  this.dialogRef.close();
              });
      }
  }

  onNoClick(): void {
      this.dialogRef.close();
  }
}
