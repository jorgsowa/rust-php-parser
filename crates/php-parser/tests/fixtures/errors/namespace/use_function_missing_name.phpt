===source===
<?php use function ;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) or \\ (T_NS_SEPARATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or fully qualified name or namespaced name in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 18,
                  "end": 18
                }
              },
              "alias": null,
              "span": {
                "start": 18,
                "end": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
