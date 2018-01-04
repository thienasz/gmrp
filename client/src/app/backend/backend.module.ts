import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BackendRoutingModule } from './backend-routing.module';
import { LayoutModule } from './layout/layout.module';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UserComponent } from './user/user.component';
import { AccountComponent } from './account/account.component';
import { GameComponent } from './game/game.component';
import { AgencyComponent } from './agency/agency.component';
import { BackendComponent } from './backend.component';
import { SharedModule } from '../shared/shared.module';
import { MaterialModule } from '../shared/material.module';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { AppInterceptor } from '../shared/services/interceptor.service';
import { RevenueComponent } from './revenue/revenue.component';
import { SettingComponent } from './setting/setting.component';
import {NgxChartsModule} from '@swimlane/ngx-charts';
import { GameService } from './game/game.service';
import { RevenueService } from './revenue/revenue.service';
import { UserService } from './user/user.service';
import { AccountService } from './account/account.service';

@NgModule({
  imports: [
    CommonModule,
    SharedModule,
    BackendRoutingModule,
    LayoutModule,
    NgxChartsModule,
  ],
  declarations: [
    BackendComponent,
    DashboardComponent,
    UserComponent,
    // GameComponent,
    // AgencyComponent,
    // RevenueComponent,
    SettingComponent
  ],
  providers: [
    // { provide: HTTP_INTERCEPTORS, useClass: AppInterceptor, multi: true },
    RevenueService,
    UserService,
    AccountService
  ]
})
export class BackendModule { }
