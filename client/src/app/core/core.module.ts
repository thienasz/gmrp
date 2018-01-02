import { NgModule, Optional, SkipSelf } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { AppInterceptor } from '../shared/services/interceptor.service';
import { AuthService } from '../auth/services/auth.service';
import { AuthGuard } from '../auth/guards/auth.guard';
import { ToastrModule } from 'ngx-toastr';
import { NgProgressModule } from 'ngx-progressbar';
import { GameService } from '../backend/game/game.service';
import { AgencyService } from '../backend/agency/agency.service';

@NgModule({
  imports: [
    // CommonModule,
    ToastrModule.forRoot({
      timeOut: 10000,
      positionClass: 'toast-bottom-right',
      preventDuplicates: true,
    }),
    NgProgressModule,
    HttpClientModule,
  ],
  exports: [
    ToastrModule,
    NgProgressModule
  ],
  declarations: [],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: AppInterceptor, multi: true },
    AuthService,
    AuthGuard,
    GameService,
    AgencyService
  ],
})
export class CoreModule { 
  constructor (@Optional() @SkipSelf() parentModule: CoreModule) {
    if (parentModule) {
      throw new Error(
        'CoreModule is already loaded. Import it in the AppModule only');
    }
  }
}
