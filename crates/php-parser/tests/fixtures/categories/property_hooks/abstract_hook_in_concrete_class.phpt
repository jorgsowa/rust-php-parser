===source===
<?php
class C { abstract public $p { get; } }
===errors===
Class C contains 1 abstract method and must therefore be declared abstract or implement the remaining method (C::$p::get)
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Class C contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (C::$p::get) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Class C contains 1 abstract method and must therefore be declared abstract or implement the remaining method (C::$p::get) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
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
                    "name": "p",
                    "span": {
                      "start": 32,
                      "end": 34
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
                        "start": 37,
                        "end": 41
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
