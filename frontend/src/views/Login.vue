<template>
  <div class="min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div
      class="absolute inset-0 bg-grid-slate-100 dark:bg-grid-slate-700/25 bg-[size:60px_60px] [mask-image:radial-gradient(ellipse_at_center,white,transparent)]"
    ></div>

    <!-- Login Card -->
    <Card
      class="relative mx-auto w-full max-w-md shadow-2xl border-0 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm animate-fade-in-up"
    >
      <!-- Header -->
      <CardHeader class="text-center pb-6">
        <div
          class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20"
        >
          <CheckSquare class="h-6 w-6 text-blue-600 dark:text-blue-400" />
        </div>
        <CardTitle
          class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100"
        >
          Sign in to your account
        </CardTitle>
        <CardDescription class="text-slate-600 dark:text-slate-400">
          Welcome back! Please enter your details.
        </CardDescription>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="handleLogin" class="space-y-4">
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
                placeholder="name@example.com"
                required
                class="pl-10 h-12 text-base border-slate-300 dark:border-slate-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-300"
              />
            </div>
          </div>

          <!-- Password -->
          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <Label
                for="password"
                class="text-sm font-medium text-slate-700 dark:text-slate-300"
                >Password</Label
              >
              <!-- <router-link
                to="/forgot-password"
                class="text-xs text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors underline-offset-4 hover:underline"
              >
                Forgot password?
              </router-link> -->
            </div>
            <div class="relative group">
              <Lock
                class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors"
              />
              <Input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                placeholder="••••••••"
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

          <!-- Remember Me -->
          <div class="flex items-center space-x-3 py-2">
            <Checkbox
              id="remember-me"
              v-model="form.remember"
              class="data-[state=checked]:bg-blue-600 data-[state=checked]:border-blue-600 focus:ring-blue-500/50"
            />
            <Label
              for="remember-me"
              class="text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer"
            >
              Remember me for 30 days
            </Label>
          </div>

          <!-- Error Message Display -->
          <Transition name="error">
            <div
              v-if="authStore.error"
              class="rounded-md bg-red-50 dark:bg-red-900/20 p-3 border border-red-200 dark:border-red-800"
            >
              <div class="flex">
                <AlertCircle
                  class="h-4 w-4 text-red-400 mt-0.5 mr-2 flex-shrink-0"
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
            {{ authStore.loading ? "Signing in..." : "Sign In" }}
          </Button>
        </form>

        <!-- OR Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <span
              class="w-full border-t border-slate-200 dark:border-slate-700"
            />
          </div>
          <div class="relative flex justify-center text-xs uppercase">
            <span
              class="bg-white/80 dark:bg-slate-800/80 px-3 text-slate-500 dark:text-slate-400 font-medium"
            >
              Or continue with
            </span>
          </div>
        </div>

        <!-- Social Logins -->
        <div class="grid grid-cols-2 gap-3">
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

      <CardFooter class="justify-center pt-2">
        <p class="text-sm text-slate-600 dark:text-slate-400">
          Don't have an account?
          <router-link
            to="/register"
            class="font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors ml-1 underline-offset-4 hover:underline"
          >
            Sign Up
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
import { Checkbox } from "@/components/ui/checkbox";
import {
  CheckSquare,
  Eye,
  EyeOff,
  Github,
  Loader2,
  Mail,
  Lock,
  AlertCircle,
} from "lucide-vue-next";

const router = useRouter();
const authStore = useAuthStore();
const notificationsStore = useNotificationsStore();

// State for the form fields
const form = ref({
  email: "",
  password: "",
  remember: false,
});

// State for password visibility
const showPassword = ref(false);

const handleLogin = async () => {
  try {
    authStore.error = null;
    await authStore.login(form.value);
    notificationsStore.success("Welcome back!");
    router.push("/tasks");
  } catch (error) {
    notificationsStore.error(authStore.error || "Login failed");
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