import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BackendComponent } from './backend.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UserComponent } from './user/user.component';
import { AccountComponent } from './account/account.component';
import { GameComponent } from './game/game.component';
import { AgencyComponent } from './agency/agency.component';
import { RevenueComponent } from './revenue/revenue.component';
import { SettingComponent } from './setting/setting.component';

const routes: Routes = [
  {
    path: '',
    component: BackendComponent,
    children: [
      // { path: '', redirectTo: 'revenues', pathMatch: true },
      {
        path: 'dashboard',
        loadChildren: 'app/backend/revenue/revenue.module#RevenueModule',
        // component: DashboardComponent
      },
      { path: 'users', component: UserComponent },
      { path: 'accounts',
        loadChildren: 'app/backend/account/account.module#AccountModule',
      },
      {
        path: 'games',
        loadChildren: 'app/backend/game/game.module#GameModule',
      },
      {
        path: 'agencies',
        loadChildren: 'app/backend/agency/agency.module#AgencyModule',
      },
      {
        path: 'revenues',
        // component: BackendComponent,
        loadChildren: 'app/backend/revenue/revenue.module#RevenueModule',
      },
      { path: 'settings', component: SettingComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BackendRoutingModule { }
