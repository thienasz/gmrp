import { AppStateModule } from './../../app-state/app-state.module';
import { NgModule } from '@angular/core';

import { SharedModule } from 'app/shared/shared.module';
import { LoginRouting } from './login-routing.module';
import { LoginFormComponent } from './components/login-form/login-form.component';
import { LoginComponent } from './login.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    SharedModule,
    LoginRouting,
    AppStateModule,
    FormsModule,
    ReactiveFormsModule
  ],
  declarations: [LoginComponent, LoginFormComponent]
})
export class LoginModule {}
