import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { BackendComponent } from './backend.component';
import { UserComponent } from './user/user.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { GameComponent } from './game/game.component';

const routes: Routes = [
  {
    path: '', 
    component: BackendComponent,
    children: [
      { path: '', component: DashboardComponent },
      { path: 'users', component: UserComponent },
      { path: 'games', component: GameComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BackendRoutingModule { }
