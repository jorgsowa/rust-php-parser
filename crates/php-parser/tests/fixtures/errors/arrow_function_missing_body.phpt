===source===
<?php fn($x) =>;
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 9,
                      "end": 11
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 11
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": "Error",
                "span": {
                  "start": 15,
                  "end": 15
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
