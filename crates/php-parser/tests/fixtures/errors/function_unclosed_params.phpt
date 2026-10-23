===source===
<?php function test(int $x { }
===errors===
Cannot declare promoted property outside a constructor
Property hook list must not be empty
missing closing ')'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ')' in Standard input code on line 1
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 1
===php_error >=8.4===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "empty_hook_list": true,
              "span": {
                "start": 20,
                "end": 26
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
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
