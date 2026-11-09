===source===
<?php new class(...) {};
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
Cannot create Closure for new expression
===errors >=8.1===
Cannot create Closure for new expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot create Closure for new expression in Standard input code on line 1
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
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": "SpreadPlaceholder",
                  "span": {
                    "start": 16,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
