===source===
<?php

/**
 * Abstract base class
 * @template T
 */
abstract class GenericBase {
    abstract public function getValue();
}

===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "GenericBase",
            "span": {
              "start": 68,
              "end": 79
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
                "Method": {
                  "name": {
                    "name": "getValue",
                    "span": {
                      "start": 111,
                      "end": 119
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 86,
                "end": 122
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Abstract base class\n * @template T\n */",
            "span": {
              "start": 7,
              "end": 52
            }
          }
        }
      },
      "span": {
        "start": 62,
        "end": 124
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 124
  }
}
