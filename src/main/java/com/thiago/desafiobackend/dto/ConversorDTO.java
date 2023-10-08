package com.thiago.desafiobackend.dto;

import jakarta.validation.constraints.NotBlank;

public record ConversorDTO(@NotBlank double valorConvertido, @NotBlank String simboloMoeda) {
}
