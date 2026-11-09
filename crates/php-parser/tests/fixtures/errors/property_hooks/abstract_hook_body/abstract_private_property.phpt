===source===
<?php
abstract class A {
    abstract private $g { get; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Property hook cannot be both abstract and private
===errors >=8.4===
Property hook cannot be both abstract and private
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Property hook cannot be both abstract and private in Standard input code on line 3
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
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
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
                        "start": 51,
                        "end": 55
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
