import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AccountRoutingModule } from './account-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { MaterialModule } from '../../shared/material.module';
import { DialogAccountForm } from './account-form/account-form.component';
import { AccountComponent } from './account.component';

@NgModule({
  imports: [
    CommonModule,
    AccountRoutingModule,
    SharedModule,
    ReactiveFormsModule,
    MaterialModule
  ],
  declarations: [
    DialogAccountForm,
    AccountComponent
  ],
  entryComponents: [DialogAccountForm]
})
export class AccountModule { }
