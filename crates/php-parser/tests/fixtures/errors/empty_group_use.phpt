===source===
<?php use A\B\{};
===errors===
expected at least one import in group use, found '}'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": []
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "}", expecting identifier or namespaced name or "function" or "const" in Standard input code on line 1
