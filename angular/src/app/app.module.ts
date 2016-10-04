import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { Cookie } from 'ng2-cookies/ng2-cookies';
import { AppComponent } from './app.component';
import { PageNotFoundComponent } from './page-not-found/index';
import { LiveChatModule } from './live-chat/live-chat.module';
import { UserService } from './shared/user.service';
import { UserResolveService } from './shared/user-resolve.service';
import { routing, appRoutingProviders } from './app.routing';
import { appConfigData } from './app-config-data';
import { APP_CONFIG } from './app.config';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        ReactiveFormsModule,
        HttpModule,
        routing,
        LiveChatModule,
    ],
    declarations: [
        AppComponent,
        PageNotFoundComponent,
    ],
    providers: [
        UserService,
        UserResolveService,
        Cookie,
        appRoutingProviders,
        { provide: APP_CONFIG, useValue: appConfigData }
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
