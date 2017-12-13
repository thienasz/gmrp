import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BackendRoutingModule } from './backend-routing.module';
import { BackendComponent } from './backend.component';
import { UserComponent } from './user/user.component';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { DashboardComponent } from './dashboard/dashboard.component';
import { LayoutModule } from '../theme/layouts/layout.module';

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    BackendRoutingModule,
    HttpClientModule,
    LayoutModule
  ],
  declarations: [BackendComponent, UserComponent, DashboardComponent]
})
export class BackendModule { }
