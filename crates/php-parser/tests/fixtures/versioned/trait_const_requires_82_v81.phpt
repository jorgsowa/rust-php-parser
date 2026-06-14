===config===
min_php=8.1
max_php=8.1
===source===
<?php
trait T {
    const X = 1;
}
===errors===
'constants in traits' requires PHP 8.2 or higher (targeting PHP 8.1)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "T",
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
===php_error===
PHP Fatal error:  Traits cannot have constants in Standard input code on line 3
