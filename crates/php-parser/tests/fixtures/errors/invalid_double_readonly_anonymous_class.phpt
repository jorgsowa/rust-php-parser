===source===
<?php new readonly readonly class {};
===errors <=8.1===
expected ';' after expression
'readonly class' requires PHP 8.2 or higher
expected class name, found '{'
===errors >=8.2===
expected ';' after expression
expected class name, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Multiple readonly modifiers are not allowed in Standard input code on line 1
===ast >=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "readonly"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": null,
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 36
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 36,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
