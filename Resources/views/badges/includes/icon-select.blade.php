<select class="form-control @error('icon') is-invalid @enderror" 
        id="icon" 
        name="icon">
    <option value="">Vælg ikon...</option>
    
    <!-- Top 10 pro ikoner -->
    <option value="fas fa-crown" {{ ($selectedIcon ?? '') == 'fas fa-crown' ? 'selected' : '' }}>
        👑 Premium
    </option>
    
    <option value="fas fa-trophy" {{ ($selectedIcon ?? '') == 'fas fa-trophy' ? 'selected' : '' }}>
        🏆 Vinder
    </option>
    
    <option value="fas fa-medal" {{ ($selectedIcon ?? '') == 'fas fa-medal' ? 'selected' : '' }}>
        🥇 Medalje
    </option>
    
    <option value="fas fa-star" {{ ($selectedIcon ?? '') == 'fas fa-star' ? 'selected' : '' }}>
        ⭐ Stjerne
    </option>
    
    <option value="fas fa-gem" {{ ($selectedIcon ?? '') == 'fas fa-gem' ? 'selected' : '' }}>
        💎 Juvel
    </option>
    
    <option value="fas fa-shield-alt" {{ ($selectedIcon ?? '') == 'fas fa-shield-alt' ? 'selected' : '' }}>
        🛡️ Beskyttet
    </option>
    
    <option value="fas fa-bolt" {{ ($selectedIcon ?? '') == 'fas fa-bolt' ? 'selected' : '' }}>
        ⚡ Lynhurtig
    </option>
    
    <option value="fas fa-fire" {{ ($selectedIcon ?? '') == 'fas fa-fire' ? 'selected' : '' }}>
        🔥 Populær
    </option>
    
    <option value="fas fa-smile" {{ ($selectedIcon ?? '') == 'fas fa-smile' ? 'selected' : '' }}>
        😊 Glade
    </option>
    
    <option value="fas fa-rocket" {{ ($selectedIcon ?? '') == 'fas fa-rocket' ? 'selected' : '' }}>
        🚀 Ambitionsfuld
    </option>
</select>
@error('icon')
    <span class="invalid-feedback">{{ $message }}</span>
@enderror