@props(['disabled' => false,  'model' => 'password'])

<div class="flex justify-between relative  items-center ">
    <input  id="password__{{ $numero = rand(1, 99999999999) }}" {{ $disabled ? 'disabled' : '' }}
    class="w-full border-gray-300  rounded-md shadow-sm" wire:model="{{ $model }}"
          type="password" name="password"  autocomplete="password__{{ $numero }}"  >

    <div id="icon__{{ $numero }}" class="w-[20px] password absolute right-2 cursor-pointer">
        <svg id="icon_eye__{{ $numero }}" xmlns="http://www.w3.org/2000/svg" class="w-full" viewBox="0 0 20 20"
            fill="currentColor">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
            <path fill-rule="evenodd"
                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943
             9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8
              0 4 4 0 018 0z"
                clip-rule="evenodd" />
        </svg>

        <svg fill="#000000" hidden id="icon_slash__{{ $numero }}" class="w-full" viewBox="0 -64 640 640"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2
          185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448
           320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55
           -85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320
            64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18
             53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3
             -30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0
              1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92
               143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z" />
        </svg>

    </div>
    <script>
        var icon = document.getElementById("icon__<?php echo $numero; ?>");
        icon.addEventListener("click", () => {
            let icon_eye = document.getElementById("icon_eye__<?php echo $numero; ?>");
            let icon_eye_slash = document.getElementById("icon_slash__<?php echo $numero; ?>");
            var input = document.getElementById("password__<?php echo $numero; ?>");
            if (input.type === "password") {
                input.type = "text";
                icon_eye_slash.removeAttribute("hidden");
                icon_eye.setAttribute("hidden", "true");
            } else {
                input.type = "password";
                icon_eye.removeAttribute("hidden");
                icon_eye_slash.setAttribute("hidden", "true");
            }
        });
    </script>

</div>
