===source===
<?php
abstract class A {
    abstract public $b = 1 { get; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$b
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$b
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$b in Standard input code on line 3
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
                    "name": "b",
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
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 54,
                        "end": 58
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
