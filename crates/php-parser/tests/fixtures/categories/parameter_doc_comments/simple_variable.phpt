===source===
<?php
function search(
    /** id to look up */
    $id,
) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "search",
          "params": [
            {
              "name": "id",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** id to look up */",
                "span": {
                  "start": 27,
                  "end": 47
                }
              },
              "span": {
                "start": 52,
                "end": 55
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
