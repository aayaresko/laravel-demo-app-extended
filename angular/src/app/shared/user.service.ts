import { Injectable } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { User } from './index';
import { Observable } from 'rxjs/Observable';
import { appConfigData } from '../app-config-data';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class UserService {
    private models: User[] = [];
    private endpointUrl = `${appConfigData.api_url}/user`;
    private headers = new Headers({ 'Content-Type': 'application/json', 'X-CSRF-TOKEN': appConfigData.csrf_token });

    public constructor(private http: Http) {
    }

    public all(): Promise<User[]> {
        return Promise.resolve(this.models);
    }

    public one(id: number): Promise<User> {
        return this.all().then((models) => models.find((user) => user.account.id === id));
    }

    public cache(model: User) {
        let index = this.models.findIndex((user) => user.account.id === model.account.id);
        if (index === -1) {
            this.models.push(model);
        } else {
            this.models[index] = model;
        }
    }

    public authenticated(): Observable<User> {
        if (typeof this.models[0] === 'undefined') {
            return this.authenticate();
        } else {
            return Observable.create((observer) => {
                observer.next(this.models[0]);
                return () => {
                }
            });
        }
    }

    private authenticate(): Observable<User> {
        return this.http
            .get(this.endpointUrl, { headers: this.headers })
            .map((response) => {
                this.cache(new User(response.json()));
                return this.models[0];
            })
            .catch(this.handleError);
    }


    private handleError(error: any) {
        return Observable.throw(error.json());
    }
}
