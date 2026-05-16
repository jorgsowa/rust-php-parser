===description===
PHP rejects `static` as a parameter modifier with
"Cannot use the static modifier on a parameter". Replaces the
generic "expected variable, found identifier" diagnostic that the
parser previously emitted when encountering `static` in this position.
===source===
<?php
class A {
    public function __construct(public static int $x) {}
}
===errors===
Cannot use the static modifier on a parameter
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 62,
                              "end": 65
                            }
                          }
                        },
                        "span": {
                          "start": 62,
                          "end": 65
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 68
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 72
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
===php_error===
PHP Fatal error:  Cannot use the static modifier on a parameter in Standard input code on line 3
