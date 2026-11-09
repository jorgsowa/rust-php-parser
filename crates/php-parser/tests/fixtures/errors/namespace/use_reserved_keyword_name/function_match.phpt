===source===
<?php
use function match;
===errors >=8.0===
expected identifier, found 'match'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "match", expecting identifier or fully qualified name or namespaced name in Standard input code on line 2
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
                "parts": [
                  "match"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 19,
                  "end": 24
                }
              },
              "alias": null,
              "span": {
                "start": 19,
                "end": 24
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
