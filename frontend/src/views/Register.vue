<template>
  <div class="min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div
      class="absolute inset-0 bg-grid-slate-100 dark:bg-grid-slate-700/25 bg-[size:60px_60px] [mask-image:radial-gradient(ellipse_at_center,white,transparent)]"
    ></div>

    <!-- Registration Card -->
    <Card
      class="relative mx-auto w-full max-w-2xl shadow-2xl border-0 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm animate-fade-in-up"
    >
      <!-- Header -->
      <CardHeader class="text-center pb-6">
        <div
          class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20"
        >
          <UserPlus class="h-8 w-8 text-blue-600 dark:text-blue-400" />
        </div>
        <CardTitle
          class="text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-100"
        >
          Create an Account
        </CardTitle>
        <CardDescription class="text-slate-600 dark:text-slate-400 mt-2">
          Enter your information to get started
        </CardDescription>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="handleRegister" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Full Name -->
            <div class="space-y-2">
              <Label
                for="full_name"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Full Name</Label
              >
              <div class="relative group">
                <User
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="full_name"
                  v-model="form.fullName"
                  placeholder="Jane Doe"
                  required
                  class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
              </div>
            </div>

            <!-- Email -->
            <div class="space-y-2">
              <Label
                for="email"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Email Address</Label
              >
              <div class="relative group">
                <Mail
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="email"
                  v-model="form.email"
                  type="email"
                  placeholder="jane.doe@example.com"
                  required
                  class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Phone Number -->
            <div class="space-y-2">
              <Label
                for="phone_number"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Phone Number (optional)</Label
              >
              <div class="relative group">
                <Phone
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="phone_number"
                  v-model="form.phoneNumber"
                  placeholder="+1 (555) 123-4567"
                  class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
              </div>
            </div>

            <!-- Address -->
            <div class="space-y-2">
              <Label
                for="address"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Address (optional)</Label
              >
              <div class="relative group">
                <Home
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="address"
                  v-model="form.address"
                  placeholder="123 Main St, Anytown, USA"
                  class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div class="space-y-2">
              <Label
                for="password"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Password</Label
              >
              <div class="relative group">
                <Lock
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="password"
                  v-model="form.password"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="•••••••• (min. 8 characters)"
                  required
                  class="pl-10 pr-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
                <Button
                  type="button"
                  variant="ghost"
                  size="icon"
                  class="absolute right-1 top-1/2 -translate-y-1/2 h-8 w-8 text-slate-400 hover:text-slate-600"
                  @click="showPassword = !showPassword"
                  aria-label="Toggle password visibility"
                >
                  <Eye v-if="!showPassword" class="h-5 w-5" />
                  <EyeOff v-if="showPassword" class="h-5 w-5" />
                </Button>
              </div>
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
              <Label
                for="password_confirmation"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Confirm Password</Label
              >
              <div class="relative group">
                <Lock
                  class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
                />
                <Input
                  id="password_confirmation"
                  v-model="form.password_confirmation"
                  type="password"
                  placeholder="••••••••"
                  required
                  class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
                />
              </div>
            </div>
          </div>

          <!-- Profile Image -->
          <div class="space-y-2">
            <Label
              for="image"
              class="text-sm font-medium text-slate-700 dark:text-slate-300"
              >Profile Image (optional)</Label
            >
            <Input
              id="image"
              type="file"
              @change="handleFileChange"
              accept="image/jpeg,image/png,image/jpg,image/gif"
              class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
            />
          </div>

          <!-- Error Message Display -->
          <Transition name="error">
            <div
              v-if="authStore.error"
              class="rounded-md bg-red-50 dark:bg-red-900/20 p-4 border border-red-200 dark:border-red-800"
            >
              <div class="flex">
                <AlertCircle
                  class="h-5 w-5 text-red-400 mt-0.5 mr-3 flex-shrink-0"
                />
                <p class="text-sm text-red-600 dark:text-red-400">
                  {{ authStore.error }}
                </p>
              </div>
            </div>
          </Transition>

          <!-- Submit Button -->
          <Button
            type="submit"
            class="w-full h-12 font-semibold text-base text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 transition-all duration-200 hover:shadow-lg"
            :disabled="authStore.loading"
          >
            <Loader2
              v-if="authStore.loading"
              class="mr-2 h-5 w-5 animate-spin"
            />
            {{ authStore.loading ? "Please wait..." : "Create Account" }}
          </Button>
        </form>

        <!-- OR Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <span
              class="w-full border-t border-slate-200 dark:border-slate-700"
            />
          </div>
          <div class="relative flex justify-center text-sm uppercase">
            <span
              class="bg-white/80 dark:bg-slate-800/80 px-4 text-slate-500 dark:text-slate-400 font-medium"
            >
              Or continue with
            </span>
          </div>
        </div>

        <!-- Social Logins -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <Button
            variant="outline"
            class="h-12 text-base transition-all duration-200 hover:shadow-md hover:border-slate-300 dark:border-slate-600 dark:hover:border-slate-500"
            :disabled="authStore.loading"
          >
            <Github class="mr-2 h-5 w-5" />
            GitHub
          </Button>
          <Button
            variant="outline"
            class="h-12 text-base transition-all duration-200 hover:shadow-md hover:border-slate-300 dark:border-slate-600 dark:hover:border-slate-500"
            :disabled="authStore.loading"
          >
            <svg class="mr-2 h-5 w-5" viewBox="0 0 24 24">
              <path
                fill="#4285F4"
                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
              />
              <path
                fill="#34A853"
                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
              />
              <path
                fill="#FBBC05"
                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
              />
              <path
                fill="#EA4335"
                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
              />
            </svg>
            Google
          </Button>
        </div>
      </CardContent>
      <CardFooter class="justify-center pt-6">
        <p class="text-base text-slate-600 dark:text-slate-400">
          Already have an account?
          <router-link
            to="/login"
            class="font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors ml-1 underline-offset-4 hover:underline"
          >
            Sign In
          </router-link>
        </p>
      </CardFooter>
    </Card>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useNotificationsStore } from "@/stores/notifications";

// Import shadcn-vue components and icons
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
  Eye,
  EyeOff,
  Github,
  Loader2,
  Mail,
  Lock,
  AlertCircle,
  UserPlus,
  User,
  Phone,
  Home,
} from "lucide-vue-next";

const router = useRouter();
const authStore = useAuthStore();
const notificationsStore = useNotificationsStore();

// State for the form fields aligned with Laravel backend
const form = ref({
  fullName: "",
  email: "",
  phoneNumber: "",
  address: "",
  password: "",
  password_confirmation: "",
  image: null,
});

// State for password visibility
const showPassword = ref(false);

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.value.image = file;
  }
};

const handleRegister = async () => {
  if (form.value.password !== form.value.password_confirmation) {
    authStore.error = "Passwords do not match.";
    notificationsStore.error("Passwords do not match");
    return;
  }

  // Use FormData to handle file uploads
  const formData = new FormData();
  formData.append("full_name", form.value.fullName);
  formData.append("email", form.value.email);
  formData.append("password", form.value.password);
  formData.append("password_confirmation", form.value.password_confirmation);

  // Append optional fields only if they have a value
  if (form.value.phoneNumber) {
    formData.append("phone_number", form.value.phoneNumber);
  }
  if (form.value.address) {
    formData.append("address", form.value.address);
  }
  if (form.value.image) {
    formData.append("image", form.value.image);
  }

  try {
    authStore.error = null;
    // Pass FormData to the auth store's register action
    await authStore.register(formData);
    notificationsStore.success("Account created successfully!");
    router.push("/tasks");
  } catch (error) {
    // Error message is expected to be set in the authStore by the action
    notificationsStore.error(
      authStore.error || "An unexpected error occurred during registration."
    );
  }
};
</script>

<style scoped>
/* Enhanced animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

/* Grid background pattern */
.bg-grid-slate-100 {
  background-image: linear-gradient(to right, #e2e8f0 1px, transparent 1px),
    linear-gradient(to bottom, #e2e8f0 1px, transparent 1px);
}

.dark .bg-grid-slate-700\/25 {
  background-image: linear-gradient(
      to right,
      rgba(51, 65, 85, 0.25) 1px,
      transparent 1px
    ),
    linear-gradient(to bottom, rgba(51, 65, 85, 0.25) 1px, transparent 1px);
}

/* Transition animations */
.error-enter-active,
.error-leave-active {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.error-enter-from,
.error-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>