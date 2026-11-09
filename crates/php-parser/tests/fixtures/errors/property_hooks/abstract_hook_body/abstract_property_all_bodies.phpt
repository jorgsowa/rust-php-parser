===source===
<?php
abstract class A {
    abstract public $e { get {} set {} }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Abstract property A::$e must specify at least one abstract hook
===errors >=8.4===
Abstract property A::$e must specify at least one abstract hook
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Abstract property A::$e must specify at least one abstract hook in Standard input code on line 3
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
                    "name": "e",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 56
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 63
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
