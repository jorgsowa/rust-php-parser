===config===
min_php=8.5
===source===
<?php enum Status { abstract public function label(): string; }
===errors===
enum methods cannot be abstract
===php_error===
PHP Fatal error:  Enum method Status::label() must not be abstract in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 45,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 60
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
