===source===
<?php
abstract class A {
    public $g { abstract final get; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use the abstract modifier on a property hook
Non-abstract property hook must have a body
===errors >=8.4===
Cannot use the abstract modifier on a property hook
Non-abstract property hook must have a body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the abstract modifier on a property hook in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 60
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
