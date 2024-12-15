@extends('layouts.app')
@section('content')
<div class="info-data">
    <div class="card">
        <div class="head">
            <div>
                <h2>1500</h2>
                <p>Traffic</p>
            </div>
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <span class="progress" data-value="50"></span>
        <span class="label">50%</span>
    </div>
    <div class="card">
        <div class="head">
            <div>
                <h2>234</h2>
                <p>Sales</p>
            </div>
            <div class="icon-down">
                <i class="bi bi-graph-down-arrow"></i>
            </div>
        </div>
        <span class="progress" data-value="40"></span>
        <span class="label">40%</span>
    </div>
    <div class="card">
        <div class="head">
            <div>
                <h2>465</h2>
                <p>Pageviews</p>
            </div>
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <span class="progress" data-value="60"></span>
        <span class="label">60%</span>
    </div>
    <div class="card">
        <div class="head">
            <div>
                <h2>235</h2>
                <p>Visitor</p>
            </div>
            <div class="icon-down">
                <i class="bi bi-graph-down-arrow"></i>
            </div>
        </div>
        <span class="progress" data-value="30"></span>
        <span class="label">30%</span>
    </div>
</div>
<div class="data">
    <div class="content-data">
        <div class="head">
            <h3>Sales Report</h3>
            <div class="menu">
                <i class="bi bi-three-dots-vertical"></i>
                <ul class="menu-link">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Save</a></li>
                    <li><a href="#">Remove</a></li>
                </ul>
            </div>
        </div>
        <div class="chart">
            <div id="chart"></div>
        </div>
    </div>
    <div class="content-data">
        <div class="head">
            <h3>Chatbox</h3>
            <div class="menu">
                <i class="bi bi-three-dots-vertical"></i>
                <ul class="menu-link">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Save</a></li>
                    <li><a href="#">Remove</a></li>
                </ul>
            </div>
        </div>
        <div class="chat-box">
            <p class="day"><span>Today</span></p>
            <div class="msg">
                <img src="img/user.png" alt="">
                <div class="chat">
                    <div class="profile">
                        <span class="username">Pheakdey</span>
                        <span class="time">10:30</span>
                    </div>
                    <p>Hello</p>
                </div>
            </div>
            <div class="msg me">
                <div class="chat">
                    <div class="profile">
                        <span class="time">10:30</span>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda, sunt.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-data">
    <div class="card">
        <form action="#">
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Purchase Date:</label>
                    <input type="date" class="form-control shadow-none" id="date">
                </div>
                <div class="col-md-6">
                    <label for="supplier">Supplier:</label>
                    <input type="text" class="form-control shadow-none" id="supplier">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control shadow-none" id="name">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
