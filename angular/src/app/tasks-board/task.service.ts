import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Task } from './index';
import { Cookie } from 'ng2-cookies/ng2-cookies';

@Injectable()
export class TaskService {
    private headers = new Headers({ 'Content-Type': 'application/json' });
    private endpointUrl = 'http://homestead.com/api/tasks';
    private token: string;

    public constructor(private http: Http) {
        this.token = Cookie.get('token');
        this.token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6Mn0.YbksTJf74BPWCX5ESGxyLrGsyP52_xZWAup1_twrYko';
        if (this.token) {
            this.headers.append('Authorization', `Bearer ${this.token}`);
        }
    }

    public all(): Observable<Task[]> {
        return this.http
            .get(this.endpointUrl, { headers: this.headers })
            .map((response: Response) => response.json())
            .catch(this.handleError);
        /**
         * .subscribe(( data: Recipe[] ) => {
					this.recipes = data;
					this.recipeChanged.emit(this.recipes);
				},
         error => console.log(error)
         );
         * */
    }

    public show(id: number): Observable<Task> {
        return this.all()
            .map((tasks) => tasks.find((task) => task.id === id));
    }

    public store(task: Task): Observable<Task> {
        return this.http
            .post(this.endpointUrl, JSON.stringify(task), { headers: this.headers })
            .map((response) => response.json())
            .catch(this.handleError);
    }

    public update(task: Task): Observable<Task> {
        let url = `${this.endpointUrl}/${task.id}`;
        return this.http
            .put(url, JSON.stringify(task), { headers: this.headers })
            .map((response) => response.json())
            .catch(this.handleError);
    }

    public destroy(id: number) {
        let url = `${this.endpointUrl}/${id}`;
        return this.http
            .delete(url, { headers: this.headers })
            .map((response) => response.json())
            .catch(this.handleError);
    }

    private handleError(error: any) {
        return Observable.throw(error.json());
    }
}
