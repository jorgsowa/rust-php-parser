===source===
<?php

class Base
{
    /**
     * Uses shared behavior.
     */
    use SharedBehavior;

    public function __construct()
    {
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Base",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "SharedBehavior"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 73,
                        "end": 87
                      }
                    }
                  ],
                  "adaptations": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Uses shared behavior.\n     */",
                    "span": {
                      "start": 24,
                      "end": 64
                    }
                  }
                }
              },
              "span": {
                "start": 69,
                "end": 88
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 94,
                "end": 135
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 137
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137
  }
}
