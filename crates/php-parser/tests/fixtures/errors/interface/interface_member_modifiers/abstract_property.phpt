===source===
<?php
interface I {
    abstract public $a { get; }
}
===errors <=8.3===
Property in interface cannot be explicitly abstract. All interface members are implicitly abstract
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Property in interface cannot be explicitly abstract. All interface members are implicitly abstract
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Property in interface cannot be explicitly abstract. All interface members are implicitly abstract in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 40,
                      "end": 42
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
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 45,
                        "end": 49
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
