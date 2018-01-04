import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserRoutingModule } from './user-routing.module';
import { SharedModule } from '../../shared/shared.module';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { FormCustomModule } from '../../components/form-custom/form-custom.module';
import { UserComponent } from './user.component';

@NgModule({
  imports: [
    CommonModule,
    UserRoutingModule,
    SharedModule,
    NgxChartsModule,
    FormCustomModule
  ],
  declarations: [
    UserComponent
  ]
})
export class UserModule { }
