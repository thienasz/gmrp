import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AccountRoutingModule } from './account-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { MaterialModule } from '../../shared/material.module';
import { DialogAccountForm } from './account-form/account-form.component';
import { AccountComponent } from './account.component';
import { SelectPermissionComponent } from '../../components/form-custom/select-permission/select-permission.component';
import { FormCustomModule } from '../../components/form-custom/form-custom.module';

@NgModule({
  imports: [
    CommonModule,
    AccountRoutingModule,
    SharedModule,
    ReactiveFormsModule,
    MaterialModule,
    FormCustomModule
  ],
  declarations: [
    DialogAccountForm,
    AccountComponent
  ],
  entryComponents: [DialogAccountForm]
})
export class AccountModule { }
