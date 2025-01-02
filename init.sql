-- Função para inserir na tabela historico_reservatorio os valores 
CREATE OR REPLACE FUNCTION inserir_historico_reservatorio()
RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO historico_reservatorios (reservatorio_id, volume, data)
    VALUES (NEW.id, NEW.volume_atual, NOW());
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Gatilho para inserir histórico ao atualizar o volume_atual
CREATE TRIGGER trigger_inserir_historico_reservatorio
AFTER UPDATE OF volume_atual ON reservatorios
FOR EACH ROW
WHEN (OLD.volume_atual IS DISTINCT FROM NEW.volume_atual)
EXECUTE FUNCTION inserir_historico_reservatorio();
