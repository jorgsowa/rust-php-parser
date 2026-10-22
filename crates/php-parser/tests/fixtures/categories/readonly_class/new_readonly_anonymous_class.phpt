===source===
<?php new readonly class {};
===errors <=8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
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
                  "start": 6,
                  "end": 27
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
