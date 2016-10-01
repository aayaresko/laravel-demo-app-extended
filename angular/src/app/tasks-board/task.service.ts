import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs';
import { Task } from './index';

@Injectable()
export class TaskService {
    private headers = new Headers({ 'Content-Type': 'application/json' });
    private endpointUrl = 'http://homestead.com/api/tasks';

    public constructor(private http: Http) {
    }

    public all() {
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

    public show(id: number) {
        return this.all()
            .map((tasks) => tasks.find((task) => task.id === id));
    }

    public store(task: Task) {
        return this.http
            .post(this.endpointUrl, JSON.stringify(task), { headers: this.headers })
            .map((response) => response.json())
            .catch(this.handleError);
    }

    public update(task: Task) {
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
