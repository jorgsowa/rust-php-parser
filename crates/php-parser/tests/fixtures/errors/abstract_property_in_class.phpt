===config===
min_php=8.4
===source===
<?php class Foo { abstract public string $bar; }
===errors===
properties cannot be abstract
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 34,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 40
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
===php_error===
PHP Fatal error:  Only hooked properties may be declared abstract in Standard input code on line 1
