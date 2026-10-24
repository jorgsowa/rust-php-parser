===source===
<?php #[A] final final class C {}
===errors >=8.0===
Multiple final modifiers are not allowed
===php_error >=8.0===
PHP Fatal error:  Multiple final modifiers are not allowed in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 33
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 29,
              "end": 30
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
