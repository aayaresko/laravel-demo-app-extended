import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { Cookie } from 'ng2-cookies/ng2-cookies';
import { AppComponent } from './app.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { LiveChatModule } from './live-chat/live-chat.module';
import { AuthorizationService } from './shared/authorization.service';
import { AuthorizationGuard } from './shared/authorization-guard.service';
import { UserResolveService } from './shared/user-resolve.service';
import { appConfigData } from './app-config-data';
import { APP_CONFIG } from './app.config';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        ReactiveFormsModule,
        AppRoutingModule,
        HttpModule,
        LiveChatModule,
    ],
    declarations: [
        AppComponent,
        PageNotFoundComponent,
    ],
    providers: [
        UserResolveService,
        AuthorizationService,
        AuthorizationGuard,
        Cookie,
        { provide: APP_CONFIG, useValue: appConfigData }
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
