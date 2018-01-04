import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminUserRoutingModule } from './admin-user-routing.module';
import { AdminUserComponent } from './admin-user.component';
import { MaterialModule } from '../../shared/material.module';
import { SharedModule } from '../../shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { DialogAdminUserForm } from './admin-user-form/admin-user-form.component';
import { FormCustomModule } from '../../components/form-custom/form-custom.module';

@NgModule({
  imports: [
    CommonModule,
    AdminUserRoutingModule,
    SharedModule,
    ReactiveFormsModule,
    MaterialModule,
    FormCustomModule
  ],
  declarations: [
    AdminUserComponent,
    DialogAdminUserForm
  ],
  entryComponents: [
    DialogAdminUserForm
  ]
})
export class AdminUserModule { }
