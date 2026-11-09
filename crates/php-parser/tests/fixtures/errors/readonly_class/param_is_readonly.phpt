===source===
<?php function foo(readonly string $x) {}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
Cannot declare promoted property outside a constructor
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
Cannot declare promoted property outside a constructor
===errors >=8.1===
Cannot declare promoted property outside a constructor
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'string' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "string", expecting variable in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 28,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "modifiers": {
                "is_readonly": true
              },
              "attributes": [],
              "span": {
                "start": 19,
                "end": 37
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
