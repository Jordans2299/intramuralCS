@extends('layouts.app')
@section('content')
    <br>
    <h2 class="resourcesHead">Helpful CS Resources</h2>
    <br>
    <div  class="boxes">
        <div id="project1" class="box">
            <a href="/blog1" class="blogBox">
            <div class="title">
                Guide to Data Structures and Algorithms
            </div>
            <div class="image">
                <img src="/Images/codingInterview.jpeg" id="codingInterviewImage">
            </div>
            <div class="description">
                Here I will break down the most common data structures and algorithms
                that are likely to see in a coding interview setting. I will also give tips
                on when to use certain data structures, and I will providing a brief analysis of the 
                time complexity of each.
            </div>
            <div class="credits">
                <small>Written By Jordan Stone</small>
            </div>
            </a>
        </div>

        <div id="project2" class="box">
            <a href="/blog2" class="blogBox">
                <div class="title">
                    Getting Started with Web Development
                </div>
                <div class="image">
                    <img src="/Images/webDev.jpeg" id="webDevImage">
                </div>
                <div class="description">
                    This guide breaks down how to get started with web development, and what
                    you will need to learn to become a full stack Web Developer. This guide will
                    not break down concepts or technologies in depth but rather list what you will need
                    to learn and point you towards recources to help you learn.
                </div>
                <div class="credits">
                    <small>Written By Jordan Stone</small>
                </div>
            </a>
        </div>
   
        <div id="project3" class="box">
            <a href="/blog3" class="blogBox">
                <div class="title">
                    Computer Science Internship Guide
                </div>
                <div class="image">
                    <img src="/Images/interns.jpeg" id="internsImage">
                </div>
                <div class="description">
                    This is a list of the major industries that are looking to hire computer
                    science majors for internships. I will also be showing some of the most common roles
                    and what they will expect you to know for that position.
                </div>
                <div class="credits">
                    <small>Written By Jordan Stone</small>
                </div>
            </a>
        </div>
    
    </div>
@endsection
