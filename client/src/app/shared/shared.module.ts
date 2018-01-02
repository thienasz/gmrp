import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { MaterialModule } from './material.module';
import { AppInterceptor } from './services/interceptor.service';
import { RouterModule } from '@angular/router';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    MaterialModule,
    // HttpClientModule,
    ReactiveFormsModule
  ],
  exports: [
    MaterialModule,
    ReactiveFormsModule
  ],
  declarations: [],
  providers: [
    // { provide: HTTP_INTERCEPTORS, useClass: AppInterceptor, multi: true },

  ],
})
export class SharedModule { }
