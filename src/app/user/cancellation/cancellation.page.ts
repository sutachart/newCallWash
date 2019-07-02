import { ModalController, NavParams } from '@ionic/angular';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';
import { Http } from '@angular/http';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-cancellation',
  templateUrl: './cancellation.page.html',
  styleUrls: ['./cancellation.page.scss'],
})
export class CancellationPage implements OnInit {

  userid: any;

  constructor(
    private nav: NavParams,
    private router: Router,
    public navHttp: Http,
    public http: HttpClient,
    public modalController: ModalController) { }

  ngOnInit() {
    this.userid = this.nav.data.user_id
  }

  cancel() {
    this.modalController.dismiss();
  }

  confirm() {
    let url: string = "http://127.0.0.1:8000/api/cancelRequest";
    let dataJson = new FormData();
    dataJson.append('tid', this.userid); // insert tid to wash
    let data: Observable<any> = this.http.post(url, dataJson)
    data.subscribe(res => {
      if (res != null) {
        console.log('Change status = C');
      }
    });
    this.modalController.dismiss();

  }



}
