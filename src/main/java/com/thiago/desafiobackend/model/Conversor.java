package com.thiago.desafiobackend.model;

import jakarta.persistence.*;

import java.util.Objects;
import java.util.UUID;

@Entity
@Table(name = "TB_CONVERSOR_MOEDA")
public class Conversor {

    @Id
    @GeneratedValue(strategy = GenerationType.UUID)
    private UUID id;
    @Column(name = "valor")
    private double amount;
    @Column(name = "tipo")
    private String from;
    @Column(name = "tipoConvertido")
    private String to;
    @Column(name = "taxa")
    private double rate;

    public Conversor() {
    }

    public Conversor(double amount, String from, String to, double rate) {
        this.amount = amount;
        this.from = from;
        this.to = to;
        this.rate = rate;
    }



    public UUID getId() {
        return id;
    }

    public void setId(UUID id) {
        this.id = id;
    }

    public double getAmount() {
        return amount;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public String getFrom() {
        return from;
    }

    public void setFrom(String from) {
        this.from = from;
    }

    public String getTo() {
        return to;
    }

    public void setTo(String to) {
        this.to = to;
    }

    public Double getRate() {
        return rate;
    }

    public void setRate(Double rate) {
        this.rate = rate;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (!(o instanceof Conversor conversor)) return false;
        return Double.compare(getAmount(), conversor.getAmount()) == 0 && Objects.equals(getId(), conversor.getId()) && Objects.equals(getFrom(), conversor.getFrom()) && Objects.equals(getTo(), conversor.getTo()) && Objects.equals(getRate(), conversor.getRate());
    }

    @Override
    public int hashCode() {
        return Objects.hash(getId(), getAmount(), getFrom(), getTo(), getRate());
    }
}
