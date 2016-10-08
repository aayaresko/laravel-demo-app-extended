import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { CoreModule } from './core/core.module';
import { LiveChatModule } from './live-chat/live-chat.module';
import { AppComponent } from './app.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { appConfigData } from './app-config-data';
import { APP_CONFIG } from './app.config';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
    imports: [
        BrowserModule,
        AppRoutingModule,
        CoreModule,
        HttpModule,
        LiveChatModule,
    ],
    declarations: [
        AppComponent,
        PageNotFoundComponent,
    ],
    providers: [
        { provide: APP_CONFIG, useValue: appConfigData }
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
