# Analytics Event Dictionary (Draft)

## Core Events

| Event | Purpose | Required Params | Optional Params |
|---|---|---|---|
| `search_performed` | Catalog search usage | `page_type`, `result_count`, `search_term_length` | `category_id`, `brand_id`, `user_type` |
| `search_no_result` | Empty search observability | `page_type`, `search_term_length` | `category_id`, `brand_id`, `user_type` |
| `product_detail_viewed` | Product detail traffic | `page_type`, `product_id` | `category_id`, `brand_id`, `user_type` |
| `quote_item_added` | Quote intent interaction | `page_type`, `product_id`, `quote_item_count` | `category_id`, `brand_id`, `user_type` |
| `quote_form_started` | Quote form funnel start | `page_type`, `quote_item_count` | `user_type` |
| `quote_form_submitted` | Successful quote conversion | `page_type`, `quote_item_count`, `user_type` | `category_id`, `brand_id` |
| `quote_form_submit_failed` | Failed quote conversion | `page_type`, `error_type`, `user_type` | `quote_item_count` |

## Privacy Guardrails

- PII (email, phone, full name, free-text quote note) is never sent as analytics payload.
- Staging analytics must use a distinct stream/property from production.
