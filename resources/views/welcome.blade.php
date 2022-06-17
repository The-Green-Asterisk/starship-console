@extends('index')

@section('main')
<div class="heading">
<div class="logo" style="width: 400px;margin: 0 auto;">
    <svg id="welcome-logo" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 902.05 724.14"><path d="M133.92,140.54c1.12-4.34,2.16-8.21,3.12-12.1a143.21,143.21,0,0,1,18.74-44,238.18,238.18,0,0,1,26.33-33.53,148.94,148.94,0,0,1,46.14-33C256.41,5.05,286-2.12,317.21.56c17.93,1.54,35,6.64,51.83,13,13.39,5,25.06,12.81,36.95,20.31,3.15,2,5.8,4.74,8.68,7.14a174.9,174.9,0,0,1,46.42,60.48,6.09,6.09,0,0,0,.58,1c7.33-5.82,14-12.55,22-17.17,16.15-9.39,33.82-12.89,52.45-9.27C551,78.87,564.5,84.63,575,96c4.56,4.9,8.68,10.23,12.76,15.55,2.48,3.23,3.49,3.57,5.64.2,6.53-10.26,15.31-18.48,24.83-25.63,20.66-15.52,44-23.47,70.12-22.9,21.44.46,41.42,5.11,60,16.65a118.17,118.17,0,0,1,43.47,46.76,114.11,114.11,0,0,1,12.57,46.34c.06,1,.25,2,.46,3.6,31.48-7,58.63.25,79.82,25.11a71,71,0,0,1,17.38,46.67H480.8c.67-6.13,1.3-12.08,2-18,.24-2.15.57-4.29.93-6.42.4-2.32-.25-3.51-2.87-3.48q-11.69.13-23.37,0c-2.6,0-3.53,1.15-3.79,3.58-.78,7.17-1.59,14.33-2.7,21.45-.18,1.19-1.85,3-2.92,3.06-5.15.32-10.32.15-16.28.15,1-9.48,2-18.52,3.09-28.16-9.67,0-18.72-.09-27.75.15-.82,0-2.07,2.13-2.26,3.39q-1.59,10.47-2.68,21c-.27,2.67-1.16,4-4,3.63a20.49,20.49,0,0,0-2.6,0H6.1c-6.19,0-6.17,0-6.08-6.19a106.51,106.51,0,0,1,18.65-59.37C29.38,167.25,43.5,154.71,60.86,147,84,136.62,108.35,133,133.92,140.54Z" style="fill:currentColor"/><path d="M342.07,351.59c.17,2.14.31,4.07.48,6,.54,5.93,3.14,8.59,9.07,8.86,4.32.19,8.66-.09,13,.12,2.75.13,3.82-.91,4.14-3.59,1.37-11.45,2.91-22.88,4.36-34.33q2.83-22.29,5.61-44.61c.49-3.85.83-7.74,1.58-11.55a3.82,3.82,0,0,1,2.55-2.53c5.16-.25,10.34-.12,16.32-.12-3.92,32.32-7.79,64.19-11.73,96.64,9.66,0,18.57.09,27.47-.14.91,0,2.41-1.91,2.57-3.07,2.13-16,4.09-32,6.06-48,1.73-14.16,3.36-28.34,5.2-42.49.13-1,1.49-2.72,2.34-2.76,5.44-.25,10.89-.13,17.06-.13-4,32.32-7.87,64.11-11.87,96.66h17.27c12.7,0,12.69,0,14.18-12.83,1-9,2.08-18,3.27-27,.23-1.74-.58-4.47,2.69-4.48,3.05,0,6.11-.11,7.51,3.6,2.7,7.14,5.54,14.24,8.33,21.35,1.8,4.55,3.66,9.09,5.43,13.65,1.27,3.29,3.63,5.45,7.07,5.52,8.92.21,17.85.07,28.12.07l-24.65-57c4.68-5.7,9.92-12,15.07-18.39,4.43-5.49,9-10.92,13-16.65,2.8-3.92,6.3-5,10.76-4.48a50.42,50.42,0,0,0,5.29,0c-.83,7.26-1.59,14.05-2.36,20.85-1.61,14.17-3.44,28.33-4.72,42.53-.69,7.63-.46,15.47,4.1,22.13,8,11.7,18.37,14.94,32.05,10.71,7.69-2.38,13.5-7.52,19.49-12.48.73-.61,1.51-1.17,2.92-2.26.13,2.21.22,3.72.31,5.23.34,6.33,3.33,9.54,9.65,9.88,4.32.24,8.66,0,13,.14,2.64.1,3.49-1.06,3.77-3.5q3-26,6.22-51.95c1.53-12.59,3.2-25.16,4.63-37.77.32-2.8,1.45-3.64,4.13-3.55,4.87.16,9.75,0,15.43,0-3.89,32.31-7.72,64.11-11.65,96.68,6.33,0,12.19.05,18,0,3.58,0,8.05,1,10.47-.77,2-1.45,1.77-6.22,2.21-9.57,1.46-11.14,2.64-22.32,4.2-33.45a50.41,50.41,0,0,1,9.07-23.11c5.13-7.05,10.73-9.27,19.24-6.8,3.71,1.07,4.62-.37,5.17-3.34,1-5.39,1.83-10.82,3.15-16.13.33-1.35,2.19-3.31,3.37-3.33,14.57-.2,29.14-.09,43.71-.05.24,0,.48.25,1.37.74-1.34,1.82-2.68,3.53-3.89,5.34-4.8,7.18-9.49,14.45-14.39,21.57-1.37,2-1.35,3.42,0,5.39q18.36,26.65,36.54,53.44c7.11,10.48,14,21.09,21.68,32.55h-5.5c-40.83,0-81.66.05-122.49-.1-3.87,0-5.45,1.26-6.67,4.85-5,14.73-10.42,29.33-15.65,44-.52,1.45-.89,3-1.69,5.69L717,420.08C686.53,505.15,658.15,590,624.63,673l-1.94-.41a76.66,76.66,0,0,1,.48-8.6q9.89-58.63,20-117.24c2.68-15.48,5.83-30.88,8.76-46.32.13-.66.11-1.35.26-3.38l-72.66,32.75c10-47.2,19.75-93.65,29.71-140.86h-5.34q-59.94,0-119.9,0c-2.76,0-4.7.16-5.86,3.47-11,31.42-22.22,62.77-33.36,94.15-.79,2.23-1.39,4.52-2.37,7.74l62.29-23.16c-30.53,85.13-58.88,170-92.37,253l-1.88-.41c.18-3.31,0-6.68.58-9.92q13.32-76.45,26.82-152.89c.67-3.83,1.34-7.66,2-11.5,0-.22-.21-.49-.58-1.28l-72,32.82c13.58-64.42,26.93-127.79,40.41-191.75-2.16-.11-3.68-.25-5.19-.25-45.88,0-91.77,0-137.65-.1-3.72,0-5.18,1.24-6.35,4.66-5.08,14.86-10.51,29.59-15.79,44.38-.51,1.44-.87,2.93-1.63,5.53l62.41-23.36c-30.46,85.13-58.87,170-92.33,253.09l-1.9-.36c.19-3.43,0-6.91.61-10.28q12.42-72.25,25-144.49c1.13-6.49,2.56-12.93,3.86-19.39l-.92-1.17L166,529.8c9.93-47.2,19.69-93.61,29.59-140.68H111c3.82-6,7-11.16,10.42-16.22,6.27-9.32,12.65-18.55,19-27.82,9.1-13.3,18.09-26.67,27.38-39.84,2.5-3.54,2.95-6.11.14-9.8-5.48-7.2-10.41-14.82-15.55-22.29-.55-.8-.95-1.71-1.83-3.33h7.25c10.39,0,20.78.09,31.16-.06,2.8,0,4.11.82,4.77,3.59,3.69,15.57,7.55,31.09,11.33,46.63,3.48,14.28,7,28.55,10.36,42.86.66,2.82,1.95,3.78,4.74,3.71,5.91-.15,11.84-.18,17.75,0,2.87.09,4.38-.94,5.62-3.54q12.65-26.53,25.57-52.93,9.18-18.84,18.59-37.55c.56-1.11,1.93-2.55,2.95-2.57,10-.2,20.05-.12,30.23.69-4.05,2.54-8.39,4.72-12.11,7.67-20.95,16.61-30.5,46.88-22.41,70.28,5.94,17.18,24.4,24.32,40,15.05C331.88,360.41,336.59,355.87,342.07,351.59Z" style="fill:currentColor"/><path d="M608.85,269.82c-1.5,12.27-3,23.68-4.27,35.11-.92,8.32-1.69,16.55-6,24.08-3.27,5.67-7.25,10.34-13.14,13.26-7.64,3.79-13.39.51-12.73-7.93,1.08-13.78,2.88-27.51,4.43-41.25.74-6.59,1.67-13.16,2.35-19.75.28-2.7,1.39-3.64,4.14-3.58C591.78,269.93,600,269.82,608.85,269.82Z" style="fill:currentColor"/><path d="M348.81,284.6c-2.05,17.21-2.68,34.19-12,49a32.74,32.74,0,0,1-6.8,7.59c-5.76,4.76-13.18,2.56-14.86-4.77-3.83-16.69-.28-32,11.87-44.18A25.9,25.9,0,0,1,348.81,284.6Z" style="fill:currentColor"/><path d="M233.32,336.47c-3.14-22.37-6.19-44.14-9.3-66.31h35.17Z" style="fill:currentColor"/><path d="M504.3,269.83c-5.29,7.37-9.93,13.88-14.61,20.36-2,2.79-4.09,5.54-6.17,8.28-2.23,2.95-4.92,4.84-9.36,3.54.3-3.17.54-6.4.93-9.62.79-6.57,1.55-13.14,2.61-19.67.18-1.08,1.77-2.74,2.75-2.77C488,269.72,495.63,269.83,504.3,269.83Z" style="fill:currentColor"/></svg>
</div>
    <h1>Valkur welcomes you</h1>
    <p>to your handy-dandy customizable, remote-capable starship console!</p>
</div>
@endsection
