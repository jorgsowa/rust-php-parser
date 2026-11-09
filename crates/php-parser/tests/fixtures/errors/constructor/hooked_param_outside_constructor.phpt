===source===
<?php function f($x { get => 1; }) {}
===errors===
Cannot declare promoted property outside a constructor
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ')' in Standard input code on line 1
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "hooks": [
                {
                  "kind": "Get",
                  "body": {
                    "Expression": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "attributes": [],
                  "span": {
                    "start": 22,
                    "end": 31
                  }
                }
              ],
              "span": {
                "start": 17,
                "end": 33
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
