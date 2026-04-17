===config===
max_php=8.4
===source===
<?php enum Status { abstract public function label(): string; }
===errors===
enum methods cannot be abstract
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "label",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
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
===php_error===
PHP Fatal error:  Enum Status must implement 1 abstract private method (Status::label) in Standard input code on line 1
