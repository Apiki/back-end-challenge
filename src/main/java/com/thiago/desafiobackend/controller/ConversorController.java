package com.thiago.desafiobackend.controller;

import com.thiago.desafiobackend.dto.ConversorDTO;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/exchange")
public class ConversorController {
    @GetMapping("{amount}/{from}/{to}/{rate}")
    public ResponseEntity<ConversorDTO> realToDolar(
            @PathVariable double amount, @PathVariable String from, @PathVariable String to, @PathVariable double rate) {

        String fromUpper = from.toUpperCase();
        String toUpper = to.toUpperCase();

        if (fromUpper.equals("BRL") || fromUpper.equals("EUR") || fromUpper.equals("USD")) {
            if (toUpper.equals("BRL") || toUpper.equals("EUR") || toUpper.equals("USD")) {
                double resultado = amount * rate;
                ConversorDTO a = new ConversorDTO(resultado, to);
                return ResponseEntity.ok().body(a);
            }
        }
        return ResponseEntity.status(HttpStatus.NOT_IMPLEMENTED).build();
    }

}
