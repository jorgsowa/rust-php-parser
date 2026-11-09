===source===
<?php
trait T {
    abstract private $i { get; }
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
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 37,
                      "end": 39
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
                        "start": 42,
                        "end": 46
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
